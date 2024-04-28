<tr class="text-slate-600 text-base bg-white border-b dark:bg-gray-800 dark:border-gray-700">
    <td class="px-6 py-2 border border-slate-300 text-blue-600 text-lg font-semibold underline">
        <a href="<?php echo $config['link'] . " " . $user->uniqueId; ?>"><?php echo $user->firstName . " " . $user->lastName; ?></a>
    </td>
    <td class="px-6 py-2 border border-slate-300"><?php echo $user->address; ?></td>
    <td class="px-6 py-2 border border-slate-300"><?php echo $user->email; ?></td>
    <td class="px-6 py-2 border border-slate-300"><?php echo $user->gender; ?></td>
    <td class="px-6 py-2 border border-slate-300"><?php echo $user->created; ?></td>
</tr>