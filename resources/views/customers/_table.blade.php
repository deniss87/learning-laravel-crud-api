<div id="customers-table">
  <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-100 border-b border-gray-100 mb-6">
          <thead>
              <tr class="bg-gray-50/50">
                  <x-sortable-th 
                      route="customers.index" 
                      field="last_name" 
                      label="Name" 
                      :currentSort="$sort" 
                      :currentDirection="$direction" 
                  />
                  <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Email</th>
                  <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Phone</th>
                  <th class="px-6 py-4 text-right text-xs font-bold text-gray-400 uppercase tracking-widest">Actions</th>
              </tr>
          </thead>
          <tbody class="divide-y divide-gray-50">
              @forelse ($customers as $customer)
                  <tr class="hover:bg-indigo-50/30 transition-colors">
                      <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                              <div class="h-10 w-10 flex-shrink-0 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                                  {{ $customer->initials }}
                              </div>
                              <div class="ms-4">
                                  <div class="text-sm font-semibold text-gray-900">{{ $customer->first_name }} {{ $customer->last_name }}</div>
                              </div>
                          </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                          {{ $customer->email }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                          {{ $customer->phone ?? '—' }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                          <div class="flex justify-end gap-3">
                              <a href="{{ route('customers.edit', $customer) }}" 
                                  class="p-2 bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                  title="Edit Customer">
                                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                              </a>

                              <form action="{{ route('customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" 
                                          class="p-2 bg-slate-50 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                          title="Delete Customer">
                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                  </button>
                              </form>
                          </div>
                      </td>
                  </tr>
              @empty
                  <tr>
                      <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">No customers found.</td>
                  </tr>
              @endforelse
          </tbody>
      </table>
  </div>

  <!-- Pagination -->
  <x-pagination :items="$customers" />
</div>