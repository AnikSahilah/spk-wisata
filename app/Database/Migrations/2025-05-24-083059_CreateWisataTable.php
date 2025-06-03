<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWisataTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_wisata' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'sub_kriteria_id' => [ // relasi ke jenis wisata di tabel sub_kriteria
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'default'    => null,
            ],
            'fasilitas' => [
                'type'       => 'TEXT',
                'null'       => true,
                'comment'    => 'Comma separated list: toilet, parkir, tempat makan, mushola',
            ],
            'harga_tiket' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
                'comment'    => 'Contoh: 15000 atau Gratis',
            ],
            'akses' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'comment'    => 'Contoh: motor, mobil, elf, bus',
            ],
            'jam_operasional' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
                'comment'    => 'Contoh: 08.00-17.00',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('sub_kriteria_id', 'sub_kriteria', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('wisata');
    }

    public function down()
    {
        $this->forge->dropTable('wisata');
    }
}
