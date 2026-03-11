<div id="orders-table">
  <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-100 border-b border-gray-100 mb-6">
          <thead>
              <tr class="bg-gray-50/50">
                  <th class="px-6 py-4 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Order #</th>
                  <x-sortable-th 
                      route="orders.index" 
                      field="customer" 
                      label="Customer" 
                      :currentSort="$sort" 
                      :currentDirection="$direction" 
                  />
                  <x-sortable-th 
                      route="orders.index" 
                      field="total_amount" 
                      label="Amount" 
                      :currentSort="$sort" 
                      :currentDirection="$direction" 
                  />
                  <x-sortable-th 
                      route="orders.index" 
                      field="status" 
                      label="Status" 
                      :currentSort="$sort" 
                      :currentDirection="$direction" 
                  />
                  <x-sortable-th 
                      route="orders.index" 
                      field="created_at" 
                      label="Date" 
                      :currentSort="$sort" 
                      :currentDirection="$direction" 
                  />
                  <th class="px-6 py-4 text-center text-xs font-bold text-gray-400 uppercase tracking-widest">Actions</th>
              </tr>
          </thead>
          <tbody class="divide-y divide-gray-50">
              @forelse ($orders as $order)
                  <tr class="hover:bg-indigo-50/30 transition-colors">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-indigo-600">
                          {{ $order->order_number }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                          {{ $order->customer->first_name }} {{ $order->customer->last_name }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                          €{{ number_format($order->total_amount, 2) }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                          <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                              {{ $order->status === 'completed' ? 'bg-green-100 text-green-700' : 
                                  ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700') }}">
                              {{ $order->status }}
                          </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                          <div class="inline-flex flex-col items-center">
                              <div class="text-sm text-gray-900 font-medium tracking-tight">
                                  {{ $order->created_at->format('d-m-Y') }}
                              </div>
                              <div class="text-[12px] uppercase tracking-tighter text-gray-400 -mt-0.5">
                                  {{ $order->created_at->format('H:i') }}
                              </div>
                          </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                          <div class="flex justify-center gap-3">
                              <a href="{{ route('orders.edit', $order) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                              </a>
                              <form action="{{ route('orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Delete this order?');">
                                  @csrf @method('DELETE')
                                  <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                  </button>
                              </form>
                          </div>
                      </td>
                  </tr>
              @empty
                  <tr>
                      <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">No orders found.</td>
                  </tr>
              @endforelse
          </tbody>
      </table>
  </div>

  <!-- Pagination -->
  <x-pagination :items="$orders" />
</div>