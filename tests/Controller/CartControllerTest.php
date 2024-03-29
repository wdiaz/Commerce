<?php

namespace App\Test\Controller;

use App\Entity\Cart;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CartControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/cart/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Cart::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Cart index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'cart[createdAt]' => 'Testing',
            'cart[uuid]' => 'Testing',
            'cart[product]' => 'Testing',
            'cart[cartUser]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Cart();
        $fixture->setCreatedAt('My Title');
        $fixture->setUuid('My Title');
        $fixture->setProduct('My Title');
        $fixture->setCartUser('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Cart');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Cart();
        $fixture->setCreatedAt('Value');
        $fixture->setUuid('Value');
        $fixture->setProduct('Value');
        $fixture->setCartUser('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'cart[createdAt]' => 'Something New',
            'cart[uuid]' => 'Something New',
            'cart[product]' => 'Something New',
            'cart[cartUser]' => 'Something New',
        ]);

        self::assertResponseRedirects('/cart/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUuid());
        self::assertSame('Something New', $fixture[0]->getProduct());
        self::assertSame('Something New', $fixture[0]->getCartUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Cart();
        $fixture->setCreatedAt('Value');
        $fixture->setUuid('Value');
        $fixture->setProduct('Value');
        $fixture->setCartUser('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/cart/');
        self::assertSame(0, $this->repository->count([]));
    }
}
