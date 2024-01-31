<?php

namespace Tdwesten\StatamicBuilder\Enums;

enum AutocompleteOption: string
{
    case AdditionalName = 'additional-name';
    case AddressLevel1 = 'address-level1';
    case AddressLevel2 = 'address-level2';
    case AddressLevel3 = 'address-level3';
    case AddressLevel4 = 'address-level4';
    case AddressLine1 = 'address-line1';
    case AddressLine2 = 'address-line2';
    case AddressLine3 = 'address-line3';
    case Bday = 'bday';
    case BdayDay = 'bday-day';
    case BdayMonth = 'bday-month';
    case BdayYear = 'bday-year';
    case CcAdditionalName = 'cc-additional-name';
    case CcCsc = 'cc-csc';
    case CcExp = 'cc-exp';
    case CcExpMonth = 'cc-exp-month';
    case CcExpYear = 'cc-exp-year';
    case CcFamilyName = 'cc-family-name';
    case CcGivenName = 'cc-given-name';
    case CcName = 'cc-name';
    case CcNumber = 'cc-number';
    case CcType = 'cc-type';
    case Country = 'country';
    case CountryName = 'country-name';
    case CurrentPassword = 'current-password';
    case Email = 'email';
    case FamilyName = 'family-name';
    case GivenName = 'given-name';
    case HonorificPrefix = 'honorific-prefix';
    case HonorificSuffix = 'honorific-suffix';
    case Language = 'language';
    case Name = 'name';
    case NewPassword = 'new-password';
    case Nickname = 'nickname';
    case Off = 'off';
    case On = 'on';
    case Organization = 'organization';
    case OrganizationTitle = 'organization-title';
    case Photo = 'photo';
    case PostalCode = 'postal-code';
    case Sex = 'sex';
    case StreetAddress = 'street-address';
    case Tel = 'tel';
    case TelAreaCode = 'tel-area-code';
    case TelCountryCode = 'tel-country-code';
    case TelExtension = 'tel-extension';
    case TelLocal = 'tel-local';
    case TelLocalPrefix = 'tel-local-prefix';
    case TelLocalSuffix = 'tel-local-suffix';
    case TelNational = 'tel-national';
    case TransactionAmount = 'transaction-amount';
    case TransactionCurrency = 'transaction-currency';
    case Url = 'url';
    case Username = 'username';
}
