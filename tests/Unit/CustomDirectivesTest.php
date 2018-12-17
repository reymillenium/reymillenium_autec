<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomDirectivesTest extends TestCase
{
    
    /**
     * Prueba las directivas echas a medida
     *
     * @test
     */
    public function it_tests_the_custom_directives()
    {
        // Permite obtener más detalles al correr las pruebas
        // $this->withoutExceptionHandling();
        
        $this->assertFalse(Blade::check('admin'));
    
    }
}
