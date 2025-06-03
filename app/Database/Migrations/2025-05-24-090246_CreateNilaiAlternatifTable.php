<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNilaiAlternatifTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'wisata_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
            'sub_kriteria_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
            'nilai' => [
                'type'       => 'FLOAT',
                'null'       => false,
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
        $this->forge->addForeignKey('wisata_id', 'wisata', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sub_kriteria_id', 'sub_kriteria', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('nilai_alternatif');
    }

    public function down()
    {
        $this->forge->dropTable('nilai_alternatif');
    }
}
