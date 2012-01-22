<?php
/*
* Rename the function to match the name of the module. Names of all news functions must be unique
* across all modules installed on a system. Return a variable called $news
*/

function helloworld_news() {
	global $db, $enrolled_courses, $system_courses;
	$news = array();

	if ($enrolled_courses == ''){
		return $news;
	} 

	$sql = 'SELECT * FROM '.TABLE_PREFIX.'news WHERE course_id IN '.$enrolled_courses.' ORDER BY date DESC';
	$result = mysql_query($sql, $db);
	if($result){
		while($row = mysql_fetch_assoc($result)){
			$news[] = array('time'=>$row['date'], 
							'object'=>$row, 
							'alt'=>_AT('announcements'),
							'course'=>$system_courses[$row['course_id']]['title'],
							'thumb'=>'images/flag_blue.png',
							'link'=>$row['body']);
		}
	}
	return $news;
}

?>
