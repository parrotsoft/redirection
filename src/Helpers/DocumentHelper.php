<?php

namespace Dnetix\Redirection\Helpers;

class DocumentHelper
{
    // Colombia Documents
    public const TYPE_CC = 'CC';
    public const TYPE_CE = 'CE';
    public const TYPE_TI = 'TI';
    public const TYPE_RC = 'RC';
    public const TYPE_NIT = 'NIT';
    public const TYPE_RUT = 'RUT';

    // Generic Documents
    public const TYPE_PPN = 'PPN';
    public const TYPE_TAX = 'TAX';
    public const TYPE_LIC = 'LIC';

    // Carnet Diplomatico
    public const TYPE_CD = 'CD';

    // USA Documents
    public const TYPE_SSN = 'SSN';

    // Panama Documents
    public const TYPE_CIP = 'CIP';

    // Brazil Documents
    public const TYPE_CPF = 'CPF';

    // Ecuador Documents
    public const TYPE_CI = 'CI';
    public const TYPE_RUC = 'RUC';

    // Peru Documents
    public const TYPE_DNI = 'DNI';

    // Costa Rica Documents
    public const TYPE_CRCPF = 'CRCPF';
    public const TYPE_CPJ = 'CPJ';
    public const TYPE_DIMEX = 'DIMEX';
    public const TYPE_DIDI = 'DIDI';

    // Chile Documents
    public const TYPE_CLRUT = 'CLRUT';

    protected static $DOCUMENT_TYPES = [
        self::TYPE_CC,
        self::TYPE_CE,
        self::TYPE_TI,
        self::TYPE_NIT,
        self::TYPE_RUT,
        self::TYPE_PPN,
        self::TYPE_TAX,
        self::TYPE_LIC,
        self::TYPE_SSN,
        self::TYPE_CIP,
        self::TYPE_CPF,
        self::TYPE_CI,
        self::TYPE_RUC,
        self::TYPE_DNI,
        self::TYPE_CRCPF,
        self::TYPE_CPJ,
        self::TYPE_DIMEX,
        self::TYPE_DIDI,
        self::TYPE_CLRUT,
    ];
    public static $VALIDATION_PATTERNS = [
        self::TYPE_CC => '/^[1-9][0-9]{3,9}$/',
        self::TYPE_CE => '/^([a-zA-Z]{1,5})?[1-9][0-9]{3,7}$/',
        self::TYPE_TI => '/^[1-9][0-9]{4,11}$/',
        self::TYPE_NIT => '/^[1-9]\d{6,9}$/',
        self::TYPE_RUT => '/^[1-9]\d{6,9}$/',
        self::TYPE_PPN => '/^[a-zA-Z0-9_]{4,16}$/',
        self::TYPE_TAX => '/^[a-zA-Z0-9_]{4,16}$/',
        self::TYPE_LIC => '/^[a-zA-Z0-9_]{4,16}$/',
        self::TYPE_SSN => '/^\d{3}\d{2,3}\d{4}$/',
        self::TYPE_CIP => '/^(PE|N|E|\d+)?\d{2,6}\d{2,6}$/',
        self::TYPE_CPF => '/^\d{10,11}$/',
        self::TYPE_CI => '/^\d{10}$/',
        self::TYPE_RUC => '/^\d{13}$/',
        self::TYPE_DNI => '/^\d{8}$/',
        self::TYPE_CRCPF => '/^[1-9][0-9]{8}$/',
        self::TYPE_CPJ => '/^[1-9][0-9]{9}$/',
        self::TYPE_DIMEX => '/^[1-9][0-9]{10,11}$/',
        self::TYPE_DIDI => '/^[1-9][0-9]{10,11}$/',
        self::TYPE_CLRUT => '/^(\d{1,3}(?:\.?\d{1,3}){2}-[\dkK])$/',
    ];

    public static function documentTypes($exclude = [])
    {
        $types = self::$DOCUMENT_TYPES;
        if ($exclude && is_array($exclude)) {
            $types = array_diff($types, $exclude);
        }
        return $types;
    }

    public static function isValidType($type)
    {
        return in_array($type, self::$DOCUMENT_TYPES);
    }

    public static function isValidDocument($type, $document)
    {
        if (!self::isValidType($type)) {
            return false;
        }

        $pattern = isset(self::$VALIDATION_PATTERNS[$type]) ? self::$VALIDATION_PATTERNS[$type] : null;
        if (!$pattern) {
            return true;
        }

        return (bool)preg_match($pattern, $document);
    }

    public static function businessDocument($document = null)
    {
        $businessDocuments = [
            self::TYPE_NIT,
            self::TYPE_RUT,
            self::TYPE_RUC,
            self::TYPE_CLRUT,
        ];
        if ($document) {
            return in_array($document, $businessDocuments);
        }
        return $businessDocuments;
    }
}
