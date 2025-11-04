<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeShippingZipRange extends Model
{
    use HasFactory;

    protected $fillable = [
        'zip_start',
        'zip_end',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Verifica se um CEP está dentro desta faixa
     *
     * @param string $zipCode CEP a ser verificado (pode conter formatação)
     * @return bool
     */
    public function isInRange(string $zipCode): bool
    {
        if (!$this->active) {
            return false;
        }

        // Remove formatação do CEP (hífen, pontos, espaços)
        $cleanZip = $this->cleanZipCode($zipCode);

        // Converte para inteiro para comparação numérica
        $zipInt = (int) $cleanZip;
        $startInt = (int) $this->zip_start;
        $endInt = (int) $this->zip_end;

        return $zipInt >= $startInt && $zipInt <= $endInt;
    }

    /**
     * Remove formatação do CEP, mantendo apenas números
     *
     * @param string $zipCode
     * @return string
     */
    public static function cleanZipCode(string $zipCode): string
    {
        return preg_replace('/[^0-9]/', '', $zipCode);
    }

    /**
     * Escopo para buscar apenas faixas ativas
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Busca faixas que contenham um determinado CEP
     *
     * @param string $zipCode
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function findByZipCode(string $zipCode)
    {
        $cleanZip = self::cleanZipCode($zipCode);
        $zipInt = (int) $cleanZip;

        return self::active()
            ->where('zip_start', '<=', $cleanZip)
            ->where('zip_end', '>=', $cleanZip)
            ->get()
            ->filter(function ($range) use ($zipInt) {
                $startInt = (int) $range->zip_start;
                $endInt = (int) $range->zip_end;
                return $zipInt >= $startInt && $zipInt <= $endInt;
            });
    }

    /**
     * Formata o CEP para exibição (00000-000)
     *
     * @param string $zipCode
     * @return string
     */
    public static function formatZipCode(string $zipCode): string
    {
        $clean = self::cleanZipCode($zipCode);
        if (strlen($clean) === 8) {
            return substr($clean, 0, 5) . '-' . substr($clean, 5, 3);
        }
        return $zipCode;
    }

    /**
     * Accessor para formatar zip_start na exibição
     */
    public function getFormattedZipStartAttribute(): string
    {
        return self::formatZipCode($this->zip_start);
    }

    /**
     * Accessor para formatar zip_end na exibição
     */
    public function getFormattedZipEndAttribute(): string
    {
        return self::formatZipCode($this->zip_end);
    }
}
