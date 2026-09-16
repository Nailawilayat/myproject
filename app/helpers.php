<?php

if (!function_exists('resolveMediaPath')) {

    function resolveMediaPath($path, $type = 'image')
    {
        if (empty($path)) {
            return null;
        }

        // New format: already inside storage (courses/... or books/...)
        if (str_starts_with($path, 'courses/') || str_starts_with($path, 'books/')) {
            return asset('storage/' . $path);
        }

        // Old format: already has folder prefix (images/... or pdfs/...)
        if (str_starts_with($path, 'images/') || str_starts_with($path, 'pdfs/')) {
            return asset($path);
        }

        // Fallback: bare filename only
        return $type === 'pdf'
            ? asset('pdfs/' . $path)
            : asset('images/' . $path);
    }

}