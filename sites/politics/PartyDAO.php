<?php

namespace party;

interface PartyDAO
{
	function getParties();
	function getParty($name);
}