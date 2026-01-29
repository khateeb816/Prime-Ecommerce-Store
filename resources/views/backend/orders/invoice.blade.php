<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; -webkit-print-color-adjust: exact; }
        .invoice-container { max-width: 800px; margin: 0 auto; padding: 40px; }
        .invoice-header { border-bottom: 2px solid #eee; padding-bottom: 20px; margin-bottom: 30px; }
        .company-logo { font-size: 28px; font-weight: 800; color: #333; letter-spacing: -1px; }
        .invoice-label { font-size: 14px; text-transform: uppercase; letter-spacing: 1px; color: #888; margin-bottom: 5px; }
        .invoice-value { font-size: 16px; font-weight: 600; color: #333; }
        .table thead th { background-color: #f8f9fa; border-bottom: none; color: #666; font-weight: 600; text-transform: uppercase; font-size: 12px; }
        .table td { vertical-align: middle; }
        .total-section { background-color: #f8f9fa; padding: 20px; border-radius: 8px; }
        .footer-note { font-size: 13px; color: #888; text-align: center; margin-top: 50px; border-top: 1px solid #eee; padding-top: 20px; }
        @media print {
            body { padding: 0; }
            .invoice-container { padding: 0; max-width: 100%; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="row invoice-header">
            <div class="col-6">
                <div class="company-logo">Prime Store</div>
                <div class="text-muted mt-2 small">Your Trusted Electronics Partner</div>
            </div>
            <div class="col-6 text-end">
                <h2 class="fw-bold text-dark mb-0">INVOICE</h2>
                <div class="mt-2 text-muted">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-6">
                <div class="invoice-label">Bill To</div>
                <div class="invoice-value">{{ $order->user->name ?? 'Guest User' }}</div>
                <div class="small text-muted">{{ $order->user->email ?? 'N/A' }}</div>
                <div class="small text-muted">{{ $order->phone }}</div>
                <div class="mt-2 small">{!! nl2br(e($order->shipping_address)) !!}</div>
            </div>
            <div class="col-6 text-end">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="invoice-label">Date</div>
                        <div class="invoice-value">{{ $order->created_at->format('M d, Y') }}</div>
                    </div>
                    <div class="col-12">
                        <div class="invoice-label">Status</div>
                        <span class="badge bg-light text-dark border">{{ ucfirst($order->status) }}</span>
                         <span class="badge bg-light text-dark border ms-1">{{ ucfirst($order->payment_status) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-borderless mb-5">
            <thead>
                <tr>
                    <th style="width: 50%">Description</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Detail</th>
                    <th class="text-end">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr class="border-bottom">
                        <td>
                            <div class="fw-bold {{ $item->product ? '' : 'text-muted' }}">{{ $item->product->name ?? 'Product Deleted' }}</div>
                            <small class="text-muted">Item ID: {{ $item->product->id ?? 'N/A' }}</small>
                        </td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-end">{{ number_format($item->price) }}</td>
                        <td class="text-end fw-bold">{{ number_format($item->price * $item->quantity) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row justify-content-end">
            <div class="col-5">
                <div class="total-section">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-bold">{{ number_format($order->total_amount) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Shipping</span>
                        <span class="text-success fw-bold">FREE</span>
                    </div>
                    <div class="border-top my-2"></div>
                    <div class="d-flex justify-content-between">
                        <span class="h5 fw-bold mb-0">Total</span>
                        <span class="h5 fw-bold text-primary mb-0">Rs. {{ number_format($order->total_amount) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-note">
            <p class="mb-1">Thank you for your business!</p>
            <p class="mb-0 small">For any support, please contact help@prime-store.com</p>
        </div>
        
        <div class="text-center mt-4 no-print">
            <button onclick="window.print()" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="bi bi-printer me-2"></i> Print Invoice</button>
            <button onclick="window.close()" class="btn btn-light rounded-pill px-4 ms-2">Close</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto print on load
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>
