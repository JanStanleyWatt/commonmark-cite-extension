<?php

/**
 * Copyright 2023 Jan Stanley Watt

 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at

 *  http://www.apache.org/licenses/LICENSE-2.0

 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace JSW\Tests;

use JSW\Cite\CiteExtension;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \JSW\Cite\Parser\CiteParser
 *
 * @group parser
 */
final class CiteTest extends TestCase
{
    private function makeExpect(string $expect)
    {
        return '<p>'.$expect.'</p>'."\n";
    }

    /**
     * @covers ::parse
     */
    public function testSimpleCite(): void
    {
        $environment = new Environment();

        $environment->addExtension(new CommonMarkCoreExtension())
                    ->addExtension(new CiteExtension());

        $converter = new MarkdownConverter($environment);

        $expect = $this->makeExpect('これが本文で<cite>これが引用元</cite>');
        $actual = $converter->convert('これが本文で""これが引用元""')->getContent();

        $this->assertSame($expect, $actual);
    }
}
