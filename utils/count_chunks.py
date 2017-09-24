#!/usr/bin/python3

import os
import sys

from os import path


def get_region_files(world_dir):
    """Return a list of region files in the world directory."""

    dimensions = [
        path.join(world_dir, "region") # Overworld
        # path.join(world_dir, "DIM-1", "region") # Nether
        # path.join(world_dir, "DIM1", "region") # The End
    ]
    files = []
    for p in dimensions:
        if path.isdir(p):
            files.extend([path.join(p, i) for i in os.listdir(p)])
    return files


def chunks_in_region_file(filename):
    """Return the number of chunks generated in a region file."""

    chunks = 0

    with open(filename, 'rb') as f:
        for i in range(1024):
            entry = f.read(4)
            if entry[-1] != 0:
                chunks += 1

    return chunks


def count_chunks(dirname):
    """Return the total number of chunks in a Minecraft world."""

    region_files = get_region_files(dirname)
    chunks = 0
    for f in region_files:
        chunks += chunks_in_region_file(f)

    return chunks


def main(args):
    print(count_chunks(args[1]))


if __name__ == '__main__':
    main(sys.argv)
