<?php

namespace sites\politics\data;

interface PartyDAO
{
	function getParties();
	function getParty($name);
}