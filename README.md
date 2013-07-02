ITNLogViewerBundle
==================

Provides a quick way to access application logs.

Installation
------------

### Composer

Add `itn/log-viewer-bundle` to your required field. Then install/update your
dependencies.

### app/AppKernel.php

Register the `ITNLogViewerBundle`:

```php
# app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new ITN\Bundle\LogViewerBundle\ITNLogViewerBundle(),
    );
}
```

### Routing

Add the following route in the `app/config/routing.yml` file.

```yaml
log_show:
    pattern:   /log/{env}
    defaults:  { _controller: ITNLogViewerBundle:Default:index }
```

**NB:** The logs will then be publicly accessible. It's up to you to restrict
the access to this route.


License
-------

This bundle is under the [MIT](https://github.com/cup-of-giraf/ITNLogViewerBundle/Resources/meta/LICENCE)
licence.
