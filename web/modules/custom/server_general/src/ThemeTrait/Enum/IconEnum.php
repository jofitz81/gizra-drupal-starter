<?php

declare(strict_types=1);

namespace Drupal\server_general\ThemeTrait\Enum;

/**
 * Enum for icon options used in links.
 */
enum IconEnum: string {
  case None = '';
  case Envelope = 'fa-envelope';
  case Phone = 'fa-phone';
}
