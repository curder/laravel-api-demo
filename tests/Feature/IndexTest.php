<?php

it('can render index page')
    ->get('/')
    ->assertSeeText('Laravel')
    ->assertOk();
