<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\InvoiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Invoice;

#[Route("/api", "api_")]
class InvoiceController extends AbstractController
{
    #[Route('/invoices', name: 'invoices', methods: ['GET'])]
    
    public function index(InvoiceRepository $invoiceRepository): JsonResponse
    {
        $invoices = $invoiceRepository->findAll();
        return $this->json($invoices);
    }


    #[Route("/invoices/{id}", "get_invoice", methods: ["GET"])]
    public function getInvoice(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $invoice = $doctrine->getRepository(Invoice::class)->find($id);
        if(!$invoice) {
            return $this->json('No employee found for the id: '. $id, 404);
        }
        
        return $this->json($invoice);
    }


    #[Route("/invoices", "create_invoice", methods: ["POST"])]
    public function createInvoice(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);
        $invoice = new Invoice();
        $invoice->setItem($requestBody["item"])
        ->setPrice($requestBody["price"])
        ->setQty($requestBody["qty"])
        ->setDescription($requestBody["description"])
        ->setAddress($requestBody["address"])
        ->setOrderedDate(new \DateTime('@'.strtotime('now')));

        $entityManger = $doctrine->getManager();
        $entityManger->persist($invoice);
        $entityManger->flush();
        return $this->json($invoice, status: Response::HTTP_CREATED);
    }

    #[Route("/invoices/{id}", "delete_invoice", methods: ["DELETE"])]
    public function deleteInvoice(ManagerRegistry $doctrine, int $id) {
        $entityManger = $doctrine->getManager();
        $invoice = $entiryManger->getRepository(Invoice::class)->find($id);
        if(!$invoice) {
            return $this->json('No employee found for id: ' . $id, 404);
        }
        $entitManger->remove($invoice);
        $entityManger->flush();
        return $this->json('Delete an Employee with id: ' . $id, Response::HTTP_NO_CONTENT);
    }
}
