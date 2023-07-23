<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Barangs extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $guarded = ['id'];

    public function scopeFiltered(Builder $builder)
    {
        $search = request('search') ?? null;
        $searchColumns = request('searchColumns') ?? null;

        $sort = request('sort') ?? null;
        $sortBy = request('sortBy') ?? null;
        $sortColumns = request('sortColumns') ?? null;

        $barangs = $builder->select(
            'barangs.id AS id',
            'barangs.name AS name',
            'barangs.price AS price',
        );

        if ($search && Str::length($search)) {
            $listSearch = Str::of($search)->split('/[\s,]+/')->toArray();
            $search = count($listSearch) > 1 ? implode("%", $listSearch) : "%{$search}%";

            $searchColumns = Str::of($searchColumns)->split('/[\s,]+/')->toArray();
            $barangs->where(function ($query) use ($search, $searchColumns) {
                foreach ($searchColumns as $searchColumn) {
                    $query->orWhereRaw("barangs.{$searchColumn} ILIKE '{$search}'");
                }
            });
        }

        $sortColumns = Str::of($sortColumns)->split('/[\s,]+/')->toArray();
        if (collect($sortColumns)->contains($sortBy) && collect(['ASC', 'DESC'])->contains($sort)) {
            $barangs->orderBy("barangs.{$sortBy}", $sort);
        }

        return $barangs;
    }
}
