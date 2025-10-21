<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'book'])->get();
        
        return response()->json($transactions);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|integer|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $book = Book::find($request->book_id);
        if ($book->stock < $request->quantity) {
            return response()->json(['message' => 'Stok buku tidak mencukupi'], 400);
        }

        $user = auth()->user();
        $totalAmount = $book->price * $request->quantity;

        // Proses transaksi
        $transaction = Transaction::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount,
        ]);

        // Kurangi stok buku
        $book->stock -= $request->quantity;
        $book->save();
        
        $transaction->load(['user', 'book']);

        return response()->json([
            'message' => 'Transaksi berhasil dibuat',
            'data' => $transaction
        ], 201);
    }

    public function show(Transaction $transaction)
    {
        // Cek apakah ID pengguna yang sedang login SAMA DENGAN customer_id di transaksi
        if (auth()->user()->id !== $transaction->customer_id) {
            return response()->json(['message' => 'Forbidden: Anda tidak memiliki akses ke transaksi ini.'], 403);
        }
        
        $transaction->load(['user', 'book']);
        return response()->json($transaction);
    }

    /**
     * [Hanya Customer] Memperbarui data transaksi (misal: jumlah buku).
     */
    public function update(Request $request, Transaction $transaction)
    {
        if (auth()->user()->id !== $transaction->customer_id) {
            return response()->json(['message' => 'Forbidden: Anda tidak dapat mengubah transaksi ini.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $book = $transaction->book;
        $oldQuantity = $transaction->quantity;
        $newQuantity = $request->quantity;

        // Hitung selisih stok yang harus dikembalikan/diambil
        $stockDifference = $oldQuantity - $newQuantity;
        
        // Cek ketersediaan stok baru
        if (($book->stock + $stockDifference) < 0) {
            return response()->json(['message' => 'Stok buku tidak mencukupi untuk jumlah baru.'], 400);
        }

        // Update stok buku
        $book->stock += $stockDifference;
        $book->save();

        // Update transaksi
        $transaction->quantity = $newQuantity;
        $transaction->total_amount = $book->price * $newQuantity;
        $transaction->save();

        $transaction->load(['user', 'book']);
        return response()->json([
            'message' => 'Transaksi berhasil diperbarui',
            'data' => $transaction
        ]);
    }

    /**
     * [Hanya Admin] Menghapus data transaksi.
     */
    public function destroy(Transaction $transaction)
    {
        // Kembalikan stok buku sebelum transaksi dihapus
        $book = $transaction->book;
        $book->stock += $transaction->quantity;
        $book->save();

        $transaction->delete();

        return response()->json(['message' => 'Transaksi berhasil dihapus dan stok buku telah dikembalikan.']);
    }
}