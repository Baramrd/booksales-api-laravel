<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction; 
use App\Models\Book; 
use App\Models\User;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = User::where('role', 'customer')->first();
        $book1 = Book::find(1);
        $book2 = Book::find(2);

        if ($customer && $book1 && $book2) {
            
            $quantity1 = 2;
            Transaction::create([
                'order_number' => 'ORD-0001',
                'customer_id' => $customer->id,
                'book_id' => $book1->id,
                'quantity' => $quantity1,
                'total_amount' => $book1->price * $quantity1,
            ]);
            $book1->decrement('stock', $quantity1);

            $quantity2 = 1;
            Transaction::create([
                'order_number' => 'ORD-0002',
                'customer_id' => $customer->id,
                'book_id' => $book2->id,
                'quantity' => $quantity2,
                'total_amount' => $book2->price * $quantity2,
            ]);
            $book2->decrement('stock', $quantity2);
        } else {
            $this->command->info('Tidak dapat menjalankan TransactionSeeder karena data user/buku tidak ditemukan.');
        }
    }
}