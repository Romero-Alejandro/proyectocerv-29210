<?php
class categoryModel extends Model
{

  // Nombre de la tabla en la base de datos
  protected $table = 'category';

  // Campos que se pueden llenar masivamente
  protected $fillable = ['name', 'color'];


  /**
   * Obtener categorías
   * @return array Array de tareas favoritas
   */
  public static function getAllCategories()
  {
    return self::all();
  }


  /**
   * Obtener todas las categorías con conteo de tareas.
   * @return array Array de categorías con el número de tareas asociadas.
   */
  public static function getAllWithTaskCount()
  {
    $sql = "SELECT 
                  c.*, 
                  COUNT(t.id) AS todo_count
              FROM category c
              LEFT JOIN todos t ON c.id = t.category_id
              GROUP BY c.id, c.name, c.created_at, c.updated_at
              ORDER BY c.name ASC";

    $stmt = Db::query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
