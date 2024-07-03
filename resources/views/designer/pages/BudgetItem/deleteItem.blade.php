 <!-- Delete form -->
 <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-link">
        <i class="fa-solid fa-delete-left"></i>
    </button>
</form>


