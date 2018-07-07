<?php
	function show_categories($parent_id="0",$insert_text="")
	{
		global $abs;
		$query_dq="SELECT * FROM tbldanhmucbaiviet WHERE parent_id=".$parent_id." ORDER BY parent_id DESC";
		$categories=mysqli_query($abs,$query_dq);
		while ($category=mysqli_fetch_array($categories,MYSQLI_ASSOC)) 
		{
			echo ("<option value='".$category["id"]."'>".$insert_text.$category['danhmucbaiviet']."</option>");
			show_categories($category["id"],$insert_text."-");
		}
		return true;
	}
	function selectCtrl($name,$class)
	{
		global $abs;
		echo "<select name='".$name."' class='".$class."'>";
		echo "<option value='0'>Danh mục cha</option>";
		show_categories();
		echo "</select>";
	}
?>