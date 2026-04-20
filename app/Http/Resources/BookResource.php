<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'judul'    => $this->judul,
            'penulis'  => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun_terbit' => (int) $this->tahun_terbit,
            'stok'         => (int) $this->stok,
            'deskripsi'    => $this->deskripsi,
            'kategori' => [
                'id'   => $this->category?->id,
                'nama' => $this->category?->nama,
            ],

            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
