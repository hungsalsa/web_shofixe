<?php 
namespace backend\models;

/**
 * summary
 */
class RecordUtil 
{
    /**
     * summary
     */
    public static function getStatusValue($data,$key,$index,$column)
    {
        if ($data->status==true) {
        	return 'Kích hoạt';
        } else {
        	return 'Tạm ẩn';        	
        }
    }
}
 ?>