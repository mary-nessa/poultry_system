<table>
    <thead>
        <tr>
            <th>Category</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Branch</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
            <tr>
                <td>{{ $expense->category }}</td>
                <td>{{ $expense->amount }}</td>
                <td>{{ $expense->date }}</td>
                <td>{{ $expense->branch->name ?? 'N/A' }}</td>
                <td>{{ $expense->description }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
