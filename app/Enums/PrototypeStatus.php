<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PrototypeStatus: string implements HasLabel, HasColor
{
    case Draft = 'draft';
    case InReview = 'in_review';
    case ClientFeedback = 'client_feedback';
    case Approved = 'approved';
    case Delivered = 'delivered';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Draft => 'مسودة',
            self::InReview => 'قيد المراجعة',
            self::ClientFeedback => 'ملاحظات العميل',
            self::Approved => 'معتمد',
            self::Delivered => 'مُسلَّم',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Draft => 'gray',
            self::InReview => 'warning',
            self::ClientFeedback => 'danger',
            self::Approved => 'success',
            self::Delivered => 'info',
        };
    }
}
