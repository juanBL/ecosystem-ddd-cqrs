### Code Style

In File | Settings | Editor | File and Code Templates

PHP class:

```php
<?php
#parse("PHP File Header.php")

#if (${NAMESPACE})
namespace ${NAMESPACE};

#end
final class ${NAME} {

}
```

PHP unit Test:

```php
<?php
#parse("PHP File Header.php")

#if (${NAMESPACE})
namespace ${NAMESPACE};
#end

#if (${TESTED_NAME} && ${NAMESPACE} && !${TESTED_NAMESPACE})
use ${TESTED_NAME};
#elseif (${TESTED_NAME} && ${TESTED_NAMESPACE} && ${NAMESPACE} != ${TESTED_NAMESPACE})
use ${TESTED_NAMESPACE}\\${TESTED_NAME};
#end

final class ${NAME} extends#if(${NAMESPACE}) \PHPUnit_Framework_TestCase #else PHPUnit_Framework_TestCase #end{

}
```

PHP unit Test 6
```php
<?php
#parse("PHP File Header.php")

#if (${NAMESPACE})
namespace ${NAMESPACE};
#end

#if (${TESTED_NAME} && ${NAMESPACE} && !${TESTED_NAMESPACE})
use ${TESTED_NAME};
#elseif (${TESTED_NAME} && ${TESTED_NAMESPACE} && ${NAMESPACE} != ${TESTED_NAMESPACE})
use ${TESTED_NAMESPACE}\\${TESTED_NAME};
#end
use PHPUnit\Framework\TestCase;

final class ${NAME} extends TestCase {

}
```

In Includes

PHP File Header:
```php

declare(strict_types=1);
```

In Code

PHP Getter method:
```php
public ${STATIC} function ${FIELD_NAME}()#if(${RETURN_TYPE}): ${RETURN_TYPE}#else#end
{
#if (${STATIC} == "static")
    return self::$${FIELD_NAME};
#else
    return $this->${FIELD_NAME};
#end
}
```