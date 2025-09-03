<?php

declare(strict_types = 1);

namespace Drupal\server_general\ThemeTrait;

use Drupal\server_general\ThemeTrait\Enum\AlignmentEnum;
use Drupal\server_general\ThemeTrait\Enum\BackgroundColorEnum;
use Drupal\server_general\ThemeTrait\Enum\FontSizeEnum;
use Drupal\server_general\ThemeTrait\Enum\TextColorEnum;

trait PersonCardThemeTrait {

  use ButtonThemeTrait;
  use CardThemeTrait;
  use ElementWrapThemeTrait;
  use InnerElementLayoutThemeTrait;

  /**
   * Build a Person card.
   *
   * @param string $image_url
   *   The image Url.
   * @param string $image_alt
   *   The image alt.
   * @param string $name
   *   The name.
   * @param string|null $subtitle
   *   (optional) The subtitle (e.g. work title).
   * @param string|null $badge
   *   (optional) The badge (e.g. "Admin").
   * @param string|null $email
   *   (optional) The email address.
   * @param string|null $telephone
   *   (optional) The telephone number.
   *
   * @return array
   *   The render array.
   */
  protected function buildElementPersonCard(string $image_url, string $image_alt, string $name, ?string $subtitle = NULL, ?string $badge = NULL, ?string $email = NULL, ?string $telephone = NULL): array {
    $elements = [];

    $element = [
      '#theme' => 'image',
      '#uri' => $image_url,
      '#alt' => $image_alt,
      '#width' => 128,
    ];
    $elements[] = $this->wrapRoundedCornersFull($element);

    $inner_elements = [];
    $inner_elements[] = $this->wrapTextCenter($name);
    if ($subtitle) {
      $element = $subtitle;
      $inner_elements[] = $this->wrapTextColor($element, TextColorEnum::Gray);
    }
    if ($badge) {
      $element = $this->wrapTextColor($badge, TextColorEnum::DarkGreen);
      $element = $this->buildLozenge($element, BackgroundColorEnum::LightGreen);
      $element = $this->wrapTextResponsiveFontSize($element, FontSizeEnum::Sm);
      $inner_elements[] = $element;
    }

    $elements[] = $this->wrapContainerVerticalSpacingTiny($inner_elements, AlignmentEnum::Center);
    $element = $this->wrapContainerVerticalSpacingBig($elements, AlignmentEnum::Center);
    $links = [];
    if ($email) {
      $links[] = $this->buildLinkEmail(t('Email'), $email);
    }
    if ($telephone) {
      $links[] = $this->buildLinkPhone(t('Call'), $telephone);
    }

    $bg_color = BackgroundColorEnum::White;

    $items = [];
    $items[] = $this->wrapContainerCentered($element);
    $items[] = $this->wrapContainerLinks($links, $bg_color);

    return $this->buildInnerElementLayoutVertical($items, $bg_color);
  }

  /**
   * Build Person cards element.
   *
   * @param array $items
   *   The render array built with
   *
   * @return array
   *   The render array.
   */
  protected function buildElementPersonCards(array $items): array {
    $element = $this->buildCards($items);
    $elements = $this->wrapContainerVerticalSpacing($element);
    return $this->wrapContainerWide($elements);
  }

}
