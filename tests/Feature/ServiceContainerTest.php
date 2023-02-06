<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{

    public function testDepedency()
    {
        $foo1 = $this->app->make(Foo::class); // new Foo()
        $foo2 = $this->app->make(Foo::class); // new Foo()

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        // $person = $this->app->make(Person::class); // new Person()
        // self::assertNotNull($person);

        $this->app->bind(Person::class, function ($app) {
            return new Person('Romi', 'Alief Rahman');
        });

        $person1 = $this->app->make(Person::class);  // closure // new Person('Romi', 'Alief Rahman)
        $person2 = $this->app->make(Person::class);  // closure // new Person('Romi', 'Alief Rahman)

        self::assertEquals('Romi', $person1->firstname);
        self::assertEquals('Romi', $person2->firstname);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person('Romi', 'Alief Rahman');
        });

        $person1 = $this->app->make(Person::class); // new Person('Romi', 'Alief Rahman) if not exists
        $person2 = $this->app->make(Person::class); // return existing
        $person3 = $this->app->make(Person::class); // return existing

        self::assertEquals('Romi', $person1->firstname);
        self::assertEquals('Romi', $person2->firstname);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person('Romi', 'Alief Rahman');
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person
        $person3 = $this->app->make(Person::class); // $person

        self::assertEquals('Romi', $person1->firstname);
        self::assertEquals('Romi', $person2->firstname);
        self::assertSame($person1, $person2);
    }

    public function testDepedencyInjection()
    {
        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertNotSame($foo, $bar->foo);
    }

    public function testDepedencyInjectionSingleton()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }

    public function testDepedencyInjectionSingletonBarMake()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);
        $bar1 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);

        self::assertNotSame($bar, $bar1);
    }

    public function testDepedencyInjectionSingletonDiClosure()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        // ambil foo yang di service container
        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);
        $bar1 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);

        self::assertSame($bar, $bar1);
    }

    public function testInterfaceToClass()
    {
        // $helloService = $this->app->make(HelloService::class);

        // self::assertEquals("Halo Romi", $helloService->hello('Romi'));


        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);
        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals("Halo Romi", $helloService->hello('Romi'));

    }
}
