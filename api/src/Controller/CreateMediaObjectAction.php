<?php
// api/src/Controller/CreateMediaObjectAction.php

namespace App\Controller;

use App\Entity\Pastrie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class CreateMediaObjectAction extends AbstractController
{
    public function __invoke(Request $request)
    {
        $pastrie = $request->attributes->get('data');

        if (!($pastrie instanceof Pastrie)) {
            throw new \RuntimeException('Expected a Pastrie');
        }
        $imageFile = $request->files->get('imageFile');
        $pastrie->setImageFile($request->files->get('imageFile'));
        $pastrie->setUpdatedAt(new \DateTimeImmutable());

        return $pastrie;
        // if (!$imageFile) {
        //     throw new BadRequestHttpException('Expected a file');
        // }

        // $pastrie->setImageFile($imageFile);

        // $this->getDoctrine()->getManager()->flush();

        // return $pastrie;
    }
}
