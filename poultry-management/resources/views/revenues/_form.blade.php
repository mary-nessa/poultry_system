<div class="space-y-4">
    <!-- Product Type -->
    <div>
        <label class="block text-gray-700 font-semibold mb-1">Product Type</label>
        <select name="product_type" required class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-200">
            <option value="" disabled {{ !isset($revenue) ? 'selected' : '' }}>Select Product</option>
            <option value="eggs" {{ (isset($revenue) && $revenue->product_type === 'eggs') ? 'selected' : '' }}>Eggs</option>
            <option value="hens" {{ (isset($revenue) && $revenue->product_type === 'hens') ? 'selected' : '' }}>Hens</option>
            <option value="other" {{ (isset($revenue) && $revenue->product_type === 'other') ? 'selected' : '' }}>Other Poultry Product</option>
        </select>
    </div>

    <!-- Quantity -->
    <div>
        <label class="block text-gray-700 font-semibold mb-1">Quantity</label>
        <input type="number" name="quantity" required min="1" value="{{ old('quantity', isset($revenue) ? $revenue->quantity : '') }}" class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-200">
    </div>

    <!-- Price Per Unit -->
    <div>
        <label class="block text-gray-700 font-semibold mb-1">Price Per Unit (UGX)</label>
        <input type="number" name="price_per_unit" required min="0" step="0.01" value="{{ old('price_per_unit', isset($revenue) ? $revenue->price_per_unit : '') }}" class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-200">
    </div>

    <!-- Sale Date -->
    <div>
        <label class="block text-gray-700 font-semibold mb-1">Sale Date</label>
        <input type="date" name="sale_date" required value="{{ old('sale_date', isset($revenue) ? $revenue->sale_date : '') }}" class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-200" max="{{ date('Y-m-d') }}">
    </div>

    <!-- Branch (Admin Only) -->
    @if(auth()->user()->hasRole('admin'))
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Branch</label>
            <select name="branch_id" required class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-200">
                <option value="" disabled {{ !isset($revenue) ? 'selected' : '' }}>Select Branch</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ (isset($revenue) && $revenue->branch_id == $branch->id) ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
        </div>
    @else
        <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}">
    @endif

    <!-- Description -->
    <div>
        <label class="block text-gray-700 font-semibold mb-1">Description</label>
        <textarea name="description" class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-200">{{ old('description', isset($revenue) ? $revenue->description : '') }}</textarea>
    </div>
</div>
