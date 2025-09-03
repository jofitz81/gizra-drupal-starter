<?php

declare(strict_types=1);

namespace Drupal\server_general\ThemeTrait;

use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Url;
use Drupal\server_general\ThemeTrait\Enum\ColorEnum;
use Drupal\server_general\ThemeTrait\Enum\LineClampEnum;
use Drupal\server_general\ThemeTrait\Enum\UnderlineEnum;

/**
 * Helper method for building a link, and decorating it.
 */
trait LinkThemeTrait {

  /**
   * Build a link.
   *
   * @param array|string|TranslatableMarkup $content
   *   The content of the link.
   * @param \Drupal\Core\Url $url
   *   The URL object.
   * @param \Drupal\server_general\ThemeTrait\Enum\ColorEnum $color
   *   The color of the link. The color on hover will be calculated from it.
   *   see `server-theme-text-decoration--link.html.twig`.
   * @param \Drupal\server_general\ThemeTrait\Enum\LineClampEnum $lines_clamp
   *   The lines to clamp. Defaults to Three.
   * @param \Drupal\server_general\ThemeTrait\Enum\UnderlineEnum $underline
   *   Determine if an underline should appear.
   *   Defaults to Hover.
   * @param bool $show_external_icon
   *   Determine if an external icon suffix should appear if the URL is
   *   external. Defaults to TRUE.
   *
   * @return array
   *   Render array.
   */
  public function buildLink(array|string|TranslatableMarkup $content, Url $url, ColorEnum $color = ColorEnum::DarkGray, LineClampEnum $lines_clamp = LineClampEnum::Three, UnderlineEnum $underline = UnderlineEnum::Hover, bool $show_external_icon = TRUE): array {
    $element = [
      '#theme' => 'server_theme_link',
      '#url' => $url,
      '#title' => $content,
      '#show_external_icon' => $show_external_icon,
      '#lines_clamp' => $lines_clamp->value,
    ];

    return [
      '#theme' => 'server_theme_text_decoration__link',
      '#color' => $color->value,
      '#underline' => $underline->value,
      '#element' => $element,
    ];
  }

  /**
   * Build a link preceded by an icon.
   *
   * @param array|string|\Drupal\Core\StringTranslation\TranslatableMarkup $content
   *   The content of the link.
   * @param \Drupal\Core\Url $url
   *   The URL object.
   * @param string|null $icon_class
   *   The icon class.
   *
   * @return array
   *   Render array.
   */
  public function buildLinkWithIcon(array|string|TranslatableMarkup $content, Url $url, ?string $icon_class = NULL): array {
    return [
      '#theme' => 'server_theme_link__with_icon',
      '#url' => $url,
      '#title' => $content,
      '#icon_class' => $icon_class,
    ];
  }

  /**
   * Build an email link (with envelope icon).
   *
   * @param array|string|\Drupal\Core\StringTranslation\TranslatableMarkup $content
   *   The content of the link.
   * @param string $email
   *   The email address.
   *
   * @return array
   *   Render array.
   */
  public function buildLinkEmail(array|string|TranslatableMarkup $content, string $email): array {
    $url = Url::fromUri("mailto:$email");
    $icon_class = 'fa-envelope';
    return $this->buildLinkWithIcon($content, $url, $icon_class);
  }

  /**
   * Build a telephone number link (with phone icon).
   *
   * @param array|string|\Drupal\Core\StringTranslation\TranslatableMarkup $content
   *   The content of the link.
   * @param string $phone
   *   The telephone number.
   *
   * @return array
   *   Render array.
   */
  public function buildLinkPhone(array|string|TranslatableMarkup $content, string $phone): array {
    $url = Url::fromUri("tel:$phone");
    $icon_class = 'fa-phone';
    return $this->buildLinkWithIcon($content, $url, $icon_class);
  }

}
