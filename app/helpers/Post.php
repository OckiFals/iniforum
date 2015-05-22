<?php

class Post {

    public static function sensor($post, $escape=true) {
        $sensor = [
            'anjing',
            'bego',
            'goblog',
            'asu',
            'jancuk',
            'jancok',
            'jancuak'
        ];

        if ($escape)
            $post = htmlspecialchars($post);

        # jika post hanya berisi satu kata
        # cocok kan dalam array
        if (in_array($post, $sensor)) {
            $pCount = strlen($post);
            $post = str_replace(
                substr($post, 1, ($pCount - 2)),
                str_repeat("*", ($pCount - 2)), $post
            );
            # jika post lebih dari satu kata
        } else {
            # iterasi sebanyak indeks $sensor
            foreach ($sensor as $value) {
                # jika post mengandung kata tak pantas dari indeks ke-n
                if (strpos($post, $value) !== false) {
                    # hitung jumlah karakter
                    $pCount = strlen($value);
                    # ganti kata tersebut dengan * sebanyak jumlah char-2
                    $post = str_replace(
                        substr($value, 1, $pCount - 2),
                        str_repeat("*", $pCount - 2), $post
                    );
                }
            }
        }

        return $post;
    }

    public static function limit($post) {
        if(strlen($post)<=200) {
            return $post;
        } else {
            $post=substr($post,0,200) . '.......';
            return $post;
        }

    }
}