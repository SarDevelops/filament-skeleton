# Filament-skeleton

- For the update Profile image go thought below steps
   - Go to the this file "vendor\filament\filament\src\AvatarProviders\UiAvatarsProvider.php"
   - change return state to 
   "return auth()->user()->profile ? asset('/storage/'.auth()->user()->profile) : 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=FFFFFF&background=' . str($backgroundColor)->after('#');"
   [ https://prnt.sc/BDd_g6bHao7l ]

