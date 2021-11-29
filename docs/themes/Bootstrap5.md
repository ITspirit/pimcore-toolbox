# Bootstrap 5 Theme
This is the default theme so there is not too much to configure.

## Setup

```yaml

toolbox:
    theme:
        grid:
            grid_size: 12
            breakpoints:
            -   identifier: 'xs'
                name: 'Breakpoint: XS'
                description: 'Your Description'
            -   identifier: 'ty'
                name: 'Breakpoint: TY'
                description: 'Your Description'
            -   identifier: 'sm'
                name: 'Breakpoint: SM'
                description: 'Your Description'
            -   identifier: 'md'
                name: 'Breakpoint: MD'
                description: 'Your Description'
            -   identifier: 'lg'
                name: 'Breakpoint: LG'
                description: 'Your Description'
            -   identifier: 'xl'
                name: 'Breakpoint: XL'
                description: 'Your Description'
            -   identifier: 'xxl'
                name: 'Breakpoint: XXL'
                description: 'Your Description'
```

## Layout

```html
<!DOCTYPE html>
<html lang="{{ app.request.locale }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ pimcore_head_title() }}
    {{ pimcore_head_meta() }}
    {{ pimcore_head_link() }}
</head>

<body>
    
    <div id="site">
    
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {% block content %}
                        {{ pimcore_areablock('content', toolbox_areablock_config('content')) }}
                    {% endblock %}
                </div>
            </div>
        </div>
    
    </div>
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>
```
