Idoheo String Generator
=======================

Simple random string generator library. String generator is defined by interface
**\Idoheo\StringGenerator\StringGeneratorInterface**.

Implemented 0-config string generators
--------------------------------------

The following string generators are pre implemented:

| Generator class                                                 | Generated string                                   |
|-----------------------------------------------------------------|----------------------------------------------------|
| Idoheo\StringGenerator\StringGenerator\AlnumCharStringGenerator | Alphanumeric string with upper and lowercase chars |
| Idoheo\StringGenerator\StringGenerator\HexStringGenerator       | Hexadecimal string generator (lowercase chars)     |
| Idoheo\StringGenerator\StringGenerator\NqCharStringGenerator    | NQCHAR = %x21 / %x23-5B / %x5D-7E                  |
| Idoheo\StringGenerator\StringGenerator\NqsCharStringGenerator   | NQSCHAR = %x20-21 / %x23-5B / %x5D-7E              |
| Idoheo\StringGenerator\StringGenerator\VsCharStringGenerator    | VSCHAR = %x20-7E                                   |

Implemented configurable string generators
------------------------------------------

| Generator class                              | Generated string                                             |
|----------------------------------------------|--------------------------------------------------------------|
| Idoheo\StringGenerator\MappedStringGenerator | String of characters provided in array passed to constructor |

Writing own generator
---------------------

To help writing your own generator, the following two abstract classes can be extended:

### \Idoheo\StringGenerator\AbstractStringGenerator

For this class you have to implement **::executeStringGeneration()** method. **$length** parameter is already checked to
be non-negative integer value, so no checking (and exception throwing) from your part is needed in case of invalid
**$length** specified.

### \Idoheo\StringGenerator\SimplifiedAbstractStringGenerator

For this class you have to implement **::getCharacter()** method to return next string character. As this is extending
previous mentioned class, no checks on $length variable are needed.
