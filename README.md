# volt-permission
A permission management system built with Livewire, Volt, and Spatie, offering a seamless way to manage user roles and access control in real-time.

<br>

## Requirements

This package requires the following dependencies to function properly:

### System Requirements
- **PHP**: ^8.2 | ^8.3 | ^8.4
- **Laravel Framework**: ^12.0

### Required Packages
- **Livewire Flux**: ^2.1.1 (Essential UI component library)
- **Livewire Volt**: ^1.7.0 (For reactive components)
- **Spatie Laravel Permission**: ^6.0@dev (Core permission management)
- **Laravel Tinker**: ^2.10.1

### Installation Note
⚠️ **Important**: This package heavily relies on **Livewire Flux** components for its user interface. Make sure you have Flux properly installed and configured in your Laravel application before using this package.

If you haven't installed Livewire Flux yet, you can add it to your project:
```bash
composer require livewire/flux
```

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
