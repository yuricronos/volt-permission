# volt-permission
A permission management system built with Livewire, Volt, and Spatie, offering a seamless way to manage user roles and access control in real-time.

<br>

## artisan command

<p>Use the artisan command `vendor:publish` with the `--tag=volt-permission` option 
to publish the Volt Permission package's configuration, views, or other assets 
to your application's directory. This allows you to customize the package's 
behavior and appearance according to your application's requirements.</p>
 
### Example:
```
php artisan vendor:publish --tag=volt-permission
```

<br>

## New Route Alias

<p>
When using the Volt Permission UI, a new route alias `volt.roles` is created. You can use this alias in your links to navigate to the roles management page seamlessly.
</p>

### Example:
```html
<a href="{{ route('volt.roles') }}">Manage Roles</a>
```
