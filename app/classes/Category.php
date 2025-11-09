<?php


class Category
{


  /**
   * Obtener el texto de categoría en español
   * @param string $category en inglés
   * @return string Category en español
   */
  public static function getCategoryText($categoryId)
  {

    $stmt = Db::query(
      "SELECT name FROM category WHERE id = ?",
      [$categoryId]
    );

    $row = $stmt->fetch();

    return $row ? $row['name'] : false;
  }

  /**
   * Obtener el color de Bootstrap para la categoría
   * @param string $category
   * @return string Clase CSS de Bootstrap
   */
  public static function getCategoryColor($categoryId)
  {
    $stmt = Db::query(
      "SELECT color FROM category WHERE id = ?",
      [$categoryId]
    );

    $row = $stmt->fetch();

    return $row ? $row['color'] : '#343a40';
  }
}
