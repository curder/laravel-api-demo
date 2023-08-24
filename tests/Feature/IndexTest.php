<?php

it('can render index page')
    ->get('/')
    ->assertOk();
