<?php

/*
 * This file is part of the Battle.net API Client package.
 *
 * (c) Jonas Stendahl <jonas@stendahl.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pwnraid\Bnet\Test\Warcraft;

use Pwnraid\Bnet\Test\TestClient;
use Pwnraid\Bnet\Warcraft\Leaderboards\LeaderboardRequest;

class LeaderboardRequestTest extends \PHPUnit_Framework_TestCase
{
    protected $request;

    protected function setUp()
    {
        $this->request = new LeaderboardRequest(new TestClient('wow'));
    }

    public function testChallengeModeRealm()
    {
        $response = $this->request->challengeMode('Argent Dawn');

        $this->assertInstanceOf('\Pwnraid\Bnet\Warcraft\Leaderboards\ChallengeModeEntity', $response);
    }

    public function testChallengeModeInvalidRealm()
    {
        $response = $this->request->challengeMode('Invalid');

        $this->assertNull($response);
    }

    public function testChallengeMode()
    {
        $response = $this->request->challengeMode();

        $this->assertInstanceOf('\Pwnraid\Bnet\Warcraft\Leaderboards\ChallengeModeEntity', $response);
    }

    public function testPvp()
    {
        $response = $this->request->pvp('2v2');

        $this->assertInstanceOf('\Pwnraid\Bnet\Warcraft\Leaderboards\BracketEntity', $response);
    }

    /**
     * @expectedException        RuntimeException
     * @expectedExceptionMessage Invalid bracket type
     */
    public function testPvpInvalidBracket()
    {
        $this->request->pvp('invalid');
    }
}
