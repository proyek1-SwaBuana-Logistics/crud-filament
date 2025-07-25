<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'disabled' => false,
    'prefix' => null,
    'required' => false,
    'suffix' => null,
    'tag' => 'label',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'disabled' => false,
    'prefix' => null,
    'required' => false,
    'suffix' => null,
    'tag' => 'label',
]); ?>
<?php foreach (array_filter(([
    'disabled' => false,
    'prefix' => null,
    'required' => false,
    'suffix' => null,
    'tag' => 'label',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<<?php echo e($tag); ?>

    <?php echo e($attributes->class(['fi-fo-field-wrp-label inline-flex items-center gap-x-3'])); ?>

>
    <?php echo e($prefix); ?>


    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
        
        <?php echo e($slot); ?><!--[if BLOCK]><![endif]--><?php if($required && (! $disabled)): ?><sup class="text-danger-600 dark:text-danger-400 font-medium">*</sup>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </span>

    <?php echo e($suffix); ?>

</<?php echo e($tag); ?>>
<?php /**PATH D:\Jejak Tugas\crud-filament\vendor\filament\forms\src\/../resources/views/components/field-wrapper/label.blade.php ENDPATH**/ ?>