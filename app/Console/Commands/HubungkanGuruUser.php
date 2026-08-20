<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Master\Guru;

class HubungkanGuruUser extends Command
{
    protected $signature = 'guru:hubungkan-user';

    protected $description = 'Menghubungkan data guru dengan akun user berdasarkan nama';

    public function handle()
    {
        $gurus = Guru::whereNull('user_id')->get();

        if ($gurus->isEmpty()) {
            $this->info('Tidak ada data guru yang user_id-nya masih NULL.');
            return Command::SUCCESS;
        }

        foreach ($gurus as $guru) {

            $user = User::where('role', 'guru')
                ->whereRaw('LOWER(name) = ?', [strtolower(trim($guru->nama))])
                ->first();

            if ($user) {

                $guru->update([
                    'user_id' => $user->id
                ]);

                $this->info(
                    "BERHASIL: {$guru->nama} → User ID {$user->id}"
                );

            } else {

                $this->warn(
                    "TIDAK DITEMUKAN: {$guru->nama}"
                );
            }
        }

        $this->newLine();

        $this->info('Proses selesai.');

        return Command::SUCCESS;
    }
}