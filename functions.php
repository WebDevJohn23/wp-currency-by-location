<?php

//// Get symbol to pass to react API along with country name
function getSymbol($countryName)
{
    switch ($countryName) {
        case 'Austria':
            $symbol = 'EUR';
            break;
        case 'Bahrain':
            $symbol = 'BHD';
            break;
        case 'Belgium':
            $symbol = 'EUR';
            break;
        case 'Egypt':
            $symbol = 'EGP';
            break;
        case 'France':
            $symbol = 'EUR';
            break;
        case 'Germany':
            $symbol = 'EUR';
            break;
        case 'Greece':
            $symbol = 'EUR';
            break;
        case 'Ireland':
            $symbol = 'EUR';
            break;
        case 'Italy':
            $symbol = 'EUR';
            break;
        case 'Kuwait':
            $symbol = 'KWD';
            break;
        case 'Netherlands':
            $symbol = 'EUR';
            break;
        case 'Oman':
            $symbol = 'OMR';
            break;
        case 'Portugal':
            $symbol = 'EUR';
            break;
        case 'Qatar':
            $symbol = 'QAR';
            break;
        case 'Saudi Arabia':
            $symbol = 'SAR';
            break;
        case 'Spain':
            $symbol = 'EUR';
            break;
        case 'Switzerland':
            $symbol = 'CHF';
            break;
        case 'Turkey':
            $symbol = 'TRY';
            break;
        case 'United Arab Emirates':
            $symbol = 'AED';
            break;
        case 'United Kingdom':
            $symbol = 'GBP';
            break;
        case 'United States':
            $symbol = 'USD';
            break;
        default:
            $symbol = 'USD';
            break;
    }
    return $symbol;
}