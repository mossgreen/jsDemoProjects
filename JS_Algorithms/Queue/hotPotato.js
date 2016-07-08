

function hotPotato(nameList, num) {
    var queue = new Queue();


    for (var i = 0; i < nameList.length; i++) {
        queue.enqueue(nameList[i]);
    }


    var eliminated = 0;
    while (queue.size() > 1) {
        for (var i = 0; i < num; i++) {
            queue.enqueue(queue.dequeue());
        }

        eliminated = queue.dequeue();
         console.log(eliminated + " deleted from this game.");
    }

    return queue.dequeue();
}
