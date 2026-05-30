<?php

namespace App\Ua;

class ImageManipulator
{
    protected string $path;
    protected mixed $image;
    protected int $width  = 0;
    protected int $height = 0;

    public function __construct(string $path)
    {
        $this->path = $path;
        if (file_exists($path)) {
            [$this->width, $this->height] = getimagesize($path);
            $this->image = imagecreatefromstring(file_get_contents($path));
        }
    }

    public function getWidth(): int  { return $this->width; }
    public function getHeight(): int { return $this->height; }

    public function crop(int $x1, int $y1, int $x2, int $y2): static
    {
        if (!$this->image) return $this;
        $w = $x2 - $x1;
        $h = $y2 - $y1;
        $cropped = imagecreatetruecolor($w, $h);
        imagecopy($cropped, $this->image, 0, 0, $x1, $y1, $w, $h);
        $this->image  = $cropped;
        $this->width  = $w;
        $this->height = $h;
        return $this;
    }

    public function save(string $path): bool
    {
        if (!$this->image) return false;
        return imagejpeg($this->image, $path, 90);
    }
}
