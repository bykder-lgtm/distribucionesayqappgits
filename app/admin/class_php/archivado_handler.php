<?php
/** * Utility functions for handling archived records (cod_estado = 0) */

class DAXArchivadoHandler {
    /**
     * Returns the SQL condition to filter out archived records.
     * @param string $alias The table alias (optional).
     * @return string
     */
    public static function getNotArchivedCondition($alias = '') {
        $prefix = $alias ? $alias . '.' : '';
        return " {$prefix}cod_estado != '0' ";
    }
    /**     * Returns the SQL condition to identify archived records.     * @param string $alias The table alias (optional).
     * @return string
     */
    public static function getArchivedCondition($alias = '') {
        $prefix = $alias ? $alias . '.' : '';
        return " {$prefix}cod_estado = '0' ";
    }
    /**     * Returns the SQL condition for archived persons (tbl15_administrador).     * Includes those with cod_estado = 0 or cod_estado_activacion_usuario = 3.
     * @param string $alias The table alias (optional).
     * @return string
     */
    public static function getArchivedPersonCondition($alias = 'a') {
        $prefix = $alias ? $alias . '.' : '';
        return " ({$prefix}cod_estado = '0' OR {$prefix}cod_estado_activacion_usuario = '3') ";
    }
    /**     * Standard status text for active records.     */
    public static function isUserActive($row) {
        return $row['cod_estado'] != '0' && $row['cod_estado_activacion_usuario'] == '1';
    }
}
?>
