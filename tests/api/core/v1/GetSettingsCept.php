<?php
// @group api
// @group admin
// @group core
$I = new AdminApiTester($scenario);
$I->wantTo('Get settings by API (api/v1/settings/get)');

// http://codeception.com/docs/10-WebServices#.Vx4676NcRBc
// http://codeception.com/docs/modules/REST#Example

/*
 * Bad method format request
 */

$I->sendGET('api/v1/settings/get', ['setting_key' => 'test']);
$I->seeResponseCodeIs(405);

/*
 * Non authenticated request
 */

$I->sendPost('api/v1/settings/get', ['setting_key' => 'test']);
$I->seeResponseCodeIs(401);

/*
 * Valid request
 */

$I->setHeader(config('apiguard.keyName'), $I->getApiAdminToken());
$I->haveHttpHeader(config('apiguard.keyName'), $I->getApiAdminToken());
$I->sendPost('api/v1/settings/get', ['setting_key' => 'test']);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->dontSeeResponseContains('{"test":"test"}');
