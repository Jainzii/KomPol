<?php

namespace sites\politics;

interface PartyDAO
{
	function getParties();
	function getParty($name);
}