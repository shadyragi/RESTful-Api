<?php

namespace App\Acme\Transformers;

class LessonTransformer extends transformer
{
	public function transform($lesson)
	{
		return [
		'title' => $lesson['title'],
		'body'  => $lesson['body'],
		'active'=> (bool)$lesson['some_boolean']
		];
	}
}

?>