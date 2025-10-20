<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Grain Trading System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'grain-orange': '#FF8C00',
                        'grain-green': '#228B22',
                        'grain-light-orange': '#FFB84D',
                        'grain-dark-green': '#006400'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-grain-light-orange to-grain-green min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-r from-grain-orange to-grain-green rounded-full mx-auto mb-4 flex items-center justify-center shadow-lg">
                        <span class="text-white text-3xl font-bold">🌾</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Grain Trading System</h2>
                    <p class="mt-2 text-gray-600">Sign in to your account</p>
                </div>

                <!-- Messages -->
                <?php if(session('success')): ?>
                    <div class="mb-6 bg-grain-green text-white p-4 rounded-lg shadow">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="mb-6 bg-red-500 text-white p-4 rounded-lg shadow">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <ul class="text-red-600 text-sm space-y-1">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <form method="POST" action="<?php echo e(route('login.post')); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address
                        </label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            autocomplete="email" 
                            required 
                            value="<?php echo e(old('email')); ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent transition duration-300 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Enter your email"
                        >
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="current-password" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent transition duration-300 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Enter your password"
                        >
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                id="remember" 
                                name="remember" 
                                type="checkbox" 
                                class="h-4 w-4 text-grain-orange focus:ring-grain-orange border-gray-300 rounded"
                            >
                            <label for="remember" class="ml-2 block text-sm text-gray-700">
                                Remember me
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="<?php echo e(route('password.request')); ?>" class="text-grain-orange hover:text-grain-dark-green transition duration-300">
                                Forgot your password?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button 
                            type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-white bg-gradient-to-r from-grain-orange to-grain-green hover:from-grain-dark-green hover:to-grain-orange focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-grain-orange transition duration-300 transform hover:scale-105 font-medium"
                        >
                            Sign In
                        </button>
                    </div>
                </form>

                <!-- Demo Credentials -->
                <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Demo Login Credentials:</h3>
                    <div class="space-y-2 text-xs text-gray-600">
                        <div class="flex justify-between">
                            <span class="font-medium">Admin:</span>
                            <span>admin@graintrading.com / password123</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Aggregator:</span>
                            <span>aggregator@graintrading.com / password123</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Farmer:</span>
                            <span>farmer@graintrading.com / password123</span>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-6 text-center">
                    <p class="text-xs text-gray-500">
                        Don't have an account? 
                        <a href="<?php echo e(route('register')); ?>" class="text-grain-orange hover:text-grain-dark-green transition duration-300">
                            Sign up here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
            
            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="<?php echo e(old('email')); ?>"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    placeholder="Enter your email"
                    required
                >
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-grain-orange focus:border-transparent <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    placeholder="Enter your password"
                    required
                >
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-6 flex items-center">
                <input 
                    type="checkbox" 
                    id="remember" 
                    name="remember" 
                    class="h-4 w-4 text-grain-orange focus:ring-grain-orange border-gray-300 rounded"
                >
                <label for="remember" class="ml-2 text-gray-700">Remember me</label>
            </div>

            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-grain-orange to-grain-green text-white font-bold py-3 px-4 rounded-lg hover:shadow-lg transform hover:scale-105 transition duration-300"
            >
                Sign In
            </button>
        </form>

        <!-- Footer Links -->
        <div class="mt-8 text-center">
            <a href="<?php echo e(route('password.request')); ?>" class="text-grain-green hover:text-grain-dark-green transition duration-300">
                Forgot your password?
            </a>
        </div>

        <!-- Test Credentials -->
        <div class="mt-8 p-4 bg-gray-100 rounded-lg">
            <h3 class="font-bold text-gray-800 mb-2">🧪 Test Credentials:</h3>
            <div class="text-sm text-gray-600 space-y-1">
                <div><strong>Admin:</strong> admin@graintrade.com</div>
                <div><strong>Aggregator:</strong> aggregator@graintrade.com</div>
                <div><strong>Farmer:</strong> mary@graintrade.com</div>
                <div class="mt-2"><strong>Password:</strong> password123</div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\SHEPHERD_2\tigula\resources\views/auth/login.blade.php ENDPATH**/ ?>