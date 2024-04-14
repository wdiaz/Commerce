<?php

namespace App\Test\Controller;

use App\Entity\Merchant;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MerchantControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/merchant/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Merchant::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Merchant index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'merchant[name]' => 'Testing',
            'merchant[uuid]' => 'Testing',
            'merchant[locationX]' => 'Testing',
            'merchant[locationY]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Merchant();
        $fixture->setName('My Title');
        $fixture->setUuid('My Title');
        $fixture->setLocationX('My Title');
        $fixture->setLocationY('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Merchant');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Merchant();
        $fixture->setName('Value');
        $fixture->setUuid('Value');
        $fixture->setLocationX('Value');
        $fixture->setLocationY('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'merchant[name]' => 'Something New',
            'merchant[uuid]' => 'Something New',
            'merchant[locationX]' => 'Something New',
            'merchant[locationY]' => 'Something New',
        ]);

        self::assertResponseRedirects('/merchant/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getUuid());
        self::assertSame('Something New', $fixture[0]->getLocationX());
        self::assertSame('Something New', $fixture[0]->getLocationY());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Merchant();
        $fixture->setName('Value');
        $fixture->setUuid('Value');
        $fixture->setLocationX('Value');
        $fixture->setLocationY('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/merchant/');
        self::assertSame(0, $this->repository->count([]));
    }
}
